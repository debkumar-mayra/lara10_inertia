import { ref } from 'vue';
import axios from 'axios';

const token = null;

class Service{

    async getData (endPoint = '', params = {}, is_token = true) {
        try{
            let url = endPoint;
               
                var options = {
                    method: 'GET',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    },
                    params
                };
                 
            let response = await axios(options);  
            return response.data;

        } catch (error) {
            if(error.response.status == 401){
                toaster.error('error');
            }
        }
    }


   async postData (endPoint = '', params = {}, is_token = true) {
        try{
            let url = endPoint;
                var options = {
                    method: 'POST',
                    url: url,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    },
                    data: params
                };
                     
            let response = await axios(options);
            return await response.data;

        } catch (error) {
            console.log(error);
            if(error.response.status == 401){
                loginCheck.setToken(0)
            }
        }
    }   

    
}

export default Service = new Service()