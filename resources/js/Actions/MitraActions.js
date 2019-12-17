import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
    FETCH_MITRA,
} from './type';

import {fetchAPI} from '../Controller/APIControll';

export const prepareMount = () => {
    return async  (dispatch) => {
        await dispatch({type: PREPARE_MOUNT, status: 'Mohon Tunggu Sebentar'})
        await dispatch({type: PAGE_PROGRESS, progress: 30, status: 'Fetching Data...'})
    }
}

export const onMounted = () => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: 'Mitra'})
    }
}

export const fetchData = (index) => {
    return async (dispatch) => {
        let response = await fetchAPI('/mitra/request?index='+index)
        if (response.status === 'success') {
            await dispatch({type: FETCH_MITRA, data: response.data.data});
        }
    }
}

export const prepareSearch = () => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_SEARCH})   
    }
}

export const onSearched = () => {
    return async (dispatch) => {
        await dispatch({type: ON_SEARCHED})
    }
}