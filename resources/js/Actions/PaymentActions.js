
import {
    FETCH_PAYMENT
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';

export const fetchPayment = (status, index, type) => {
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try{
            let resMedia = await mainApi.get('/payment/getPayment?status='+status+'&index='+index+'&type='+type, configJSON);
            if (resMedia.status === 200) {
                dispatch({type: FETCH_PAYMENT, data: resMedia.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_PAYMENT, data: []})
        }
    }
}