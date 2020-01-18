import {mainApi} from '../Controller/APIControll';

export const postNews = (data) =>{
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        
        try{
            let response = await mainApi.get('/advertiser/cAdvertiser', configJSON)
            if (response.status === 200) {
                await dispatch({type: FETCH_QTY_ADVERTISER, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
        }
        
    }
}
export const patchNews = (data) =>{
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        
        try{
            let response = await mainApi.get('/advertiser/cAdvertiser', configJSON)
            if (response.status === 200) {
                await dispatch({type: FETCH_QTY_ADVERTISER, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
        }
        
    }
}