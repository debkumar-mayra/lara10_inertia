// const Confirm = Swal.mixin({
//     toast: false,
//     position: 'center',
//     showConfirmButton: true,
//     // timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//       toast.addEventListener('mouseenter', Swal.stopTimer)
//       toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
//   });

//   const Toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     showCloseButton:true,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//       toast.addEventListener('mouseenter', Swal.stopTimer)
//       toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
//   });


// var Emitter = require('tiny-emitter');
// var emitter = new Emitter();
// import eventBus from '../eventBus';
import emitter from 'tiny-emitter/instance';

class SweetAlert{


    confirm(funName,argument, title= 'Are you sure?', text= "You won't be able to revert this!",icon='warning',confirmButtonText= 'Yes, delete it!'){
        // false;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              emitter.emit(funName, argument);
              // eventBus.$emit('custom-event');
                // yesDelete()
                // returnResult = true;
            //   Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //   )
            }
          })


    }

    alert(title='Title!',message='Your message', type='success'){
        Swal.fire(
            title,
            message,
            type
          )
    }

    toast(icon='success',title='Your message'){

        Swal.fire({
              icon: 'success',
              title: 'Signed in successfully',
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              showCloseButton:true,
              timer: 3000,
            //   background: 'green',
            //   color:'white',
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }

            })
    }
}

export default SweetAlert = new SweetAlert()