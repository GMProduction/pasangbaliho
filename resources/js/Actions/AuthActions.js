import {
    FETCH_AUTH
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';

export const isAuth = (data) => {
    return async (dispatch) => {
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
            }   
        }
        try{
            let res = await mainApi.post('/login', data, configJSON)
            if(res.status === 200){
                const user = JSON.stringify(res.data.user)
                localStorage.setItem('user', user);
                return {status: res.status, message: res.data.message};
            }else{
                return {status: res.status, message: res.data.message};
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            return {status: 'failed', message: 'Failed Connect To Server...'};
        }
    }
}