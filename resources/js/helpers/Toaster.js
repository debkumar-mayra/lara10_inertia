import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ /* options */ });
class Toaster{
    
    success(message){
        toaster.success(message, { position:'top-right'});
    }

    error(message){
        toaster.error(message, { position:'top-right'});
    }

    warning(message){
        toaster.warning(message, { position:'top-right'});
    }

    info(message){
        toaster.info(message, { position:'top-right'});
    }
}

export default Toaster = new Toaster()