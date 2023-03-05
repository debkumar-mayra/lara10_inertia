import { ref } from 'vue';
import axios from 'axios';


export default function useService() {

    const token = null;

    const getData = async (endPoint = '', params = {}, is_token = true) => {
        try{
            let url = endPoint;
            if(is_token){            
                var options = {
                    method: 'GET',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8',
                        'Authorization': `Bearer ${token}` 
                    },
                    params
                };
            }else{        
                var options = {
                    method: 'GET',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    },
                    params
                };
            }       
            let response = await axios(options);  
            return response.data;

        } catch (error) {
            if(error.response.status == 401){
                loginCheck.setToken(0)
            }
        }
    }


    const postData = async (endPoint = '', params = {}, is_token = true) => {
        try{
            let url = endPoint;
            if(is_token){
                var options = {
                    method: 'POST',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8',
                        'Authorization': `Bearer ${token}`
                    },
                    data: params
                };
            }else{
                var options = {
                    method: 'POST',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    },
                    data: params
                };
            }            
            let response = await axios(options);
            return await response.data;

        } catch (error) {
            console.log(error);
            if(error.response.status == 401){
                loginCheck.setToken(0)
            }
        }
    }   

    return {
        getData,
        postData
    }
}