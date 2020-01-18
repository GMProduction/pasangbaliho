
import {
    FETCH_PAYMENT,
    FETCH_PAYMENT_BY_ID
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

export const fetchPaymentById = (status, type, id) => {
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
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        try{
            let resNego = await mainApi.get('/payment/requestPaymentById?status='+status+'&type='+type+'&id='+id, configJSON);
            if (resNego.status === 200) {
                dispatch({type: FETCH_PAYMENT_BY_ID, data: resNego.data, dataFound: true})
            }else {
                dispatch({type: FETCH_PAYMENT_BY_ID, data: null, dataFound: false})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_PAYMENT_BY_ID, data: null, dataFound: false})
        }
        
    }
}