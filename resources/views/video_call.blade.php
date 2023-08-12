<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Video Call-Created By Anitesh Mondal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <style type="text/css">
        button.dt-button, div.dt-button, a.dt-button {
            margin-left: 5px;
            padding: 0.3em 1em;
        }
    </style>

</head>
<body>
<div class="card-body">
    <div class="videocallBg">
        <div id="remote-video-container" class="remote_video_div"></div>
        <div id="local-video-container" class="local_video_div"></div>
    </div>
</div>
<div class="card-footer">
    <input type="hidden" id="txt-roomid" class="form-control" placeholder="unique room Id">
    <button id="btn-open-or-join-room" class="btn btn-success">Join Room</button>
    <button id="start-recording" class="btn btn-warning">Record</button>
    <button id="stop-recording" class="btn btn-danger" disabled>Call End</button>


    <a id="save-recording" class="btn btn-dark float-right"
       href="http://localhost/vim/public/admin/profile-verification-schedule"> Back</a>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
{{-- <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script> --}}
<script src="
https://cdn.jsdelivr.net/npm/rtcmulticonnection@3.7.1/dist/RTCMultiConnection.min.js
"></script>
<script src="https://cdn.webrtc-experiment.com:443/FileBufferReader.js"></script>
<script src="https://cdn.webrtc-experiment.com/MediaStreamRecorder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/record-entire-meeting@1.0.2/Browser-Recording-Helper.js"></script>
{{-- <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script> --}}
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var connection = new RTCMultiConnection();
    // this line is VERY_important
    connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/'; // signalling channel

    // if you want audio+video conferencing
    connection.session = {
        audio: true,
        video: true
    };
    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: true,
        OfferToReceiveVideo: true
    };


    var localVideoContainer = document.getElementById('local-video-container');// local video div container
    var remoteVideoContainer = document.getElementById('remote-video-container');// remote video div container
    var remoteStream = {};

    /**
     * When connection is made video is open with this code in your browser
     * **/
    connection.onstream = function (event) {
        var video = event.mediaElement;
        if (event.type == 'local') {
            localVideoContainer.appendChild(video);
        }
        if (event.type == 'remote') {
            remoteVideoContainer.appendChild(video);
            remoteStream = event.stream;
            startRecording();
        }
    }


    var roomid = document.getElementById('txt-roomid');
    // roomid.value = {{rand(1000000000000000,99999999999999999)}};
    roomid.value = '7177121012021120405';

    document.getElementById('btn-open-or-join-room').onclick = function () {
        console.log('join Room Button');
        this.disabled = true;
        connection.openOrJoin(roomid.value || 'predefined-roomid');
    }

    //this below section we are used for recording
    var mediaConstraints = {
        audio: true,
        video: true
    };

    function onMediaError(e) {
        console.error('media error', e);
    }

    var videosContainer = document.getElementById('remote-video-container');
    function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
        console.log('Capture user media');
        navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
    }

    /**
     * Start recording is hear
     **/ 
    function startRecording() {
        this.disabled = true;
        $("#start-recording").prop("disabled", true);
        $("#stop-recording").prop("disabled", false);
        $("#save-recording").prop("disabled", true);
        captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
    }
    
    
    /**
     * If data available start recording and upload data in server with 50000000 milisecond
     * **/
    var mediaRecorder;
    function onMediaSuccess(stream) {
        var arrayOfStreams = [stream, remoteStream];
        mediaRecorder = new MultiStreamRecorder(arrayOfStreams);
        mediaRecorder.ondataavailable = function (blob) {
            uploadToPHPServer(blob);
        };
        mediaRecorder.start(50000000);
    }

    /**
     * Make the temp video file is hear and creation the object for send video file in server
     * **/
    function uploadToPHPServer(blob) {
        var file = new File([blob], 'msr-' + (new Date).toISOString().replace(/:|\./g, '-') + '.webm', {
            type: 'video/webm'
        });
        var formData = new FormData();
        formData.append('video_blob', file);
        formData.append('room_id', '7177121012021120405');
        formData.append('_token', 'yz2RRZcw4QTL0LpbnwWJigudAblwJHLyenpGSU5l');
        makeXMLHttpRequest('http://localhost/vim/public/admin/profile-verification-call-record-video', formData, function () {
            console.log('File upload is complete');
        });
    }

    /**
     * Thgis function I am used for server side rendering data save in server for video recording
     **/
    function makeXMLHttpRequest(url, data, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                callback();
            }
        };
        request.open('POST', url);
        request.send(data);
    }

    /*
    * This function I am used for stop recording and close connection
    * */
    
    document.querySelector('#stop-recording').onclick = function () {
        this.disabled = true;
        mediaRecorder.stop();
        $("#start-recording").prop("disabled", false);
        $("#save-recording").prop("disabled", false);
        $("#btn-open-or-join-room").prop("disabled", false);
        
        // connection closed code are below        
        connection.getAllParticipants().forEach(function (pid) {
            connection.disconnectWith(pid);
        });
        connection.attachStreams.forEach(function (localStream) {
            localStream.stop();
        });
        connection.closeSocket();
    };
</script>
</body>
</html>
