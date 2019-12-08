import {
    FETCH_MITRA,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from './type';

import {dashboardAPI} from '../Controller/DashboardControll';

export const onMount = () => {
    return async (dispatch) => {
        dispatch({type: PREPARE_MOUNT, loadingStatus: 'Fetching Data Mitra...',});
        let resMitra = await dashboardAPI('/adminapi/mitra/request?index=')
        if (resMitra.statusdata === 'success') {
            dispatch({
                type: FETCH_MITRA, 
                data: resMitra.data.data, 
            })
        }
        dispatch({type: ON_MOUNTED});
    }
}

export const onSearch = index => {
    return async dispatch => {
       await dispatch({type:PREPARE_SEARCH, dataLoading: true});
        let resMitra = await dashboardAPI('/adminapi/mitra/request?index='+index)
        if (resMitra.statusdata === 'success') {
            await dispatch({
                type: FETCH_MITRA, 
                data: resMitra.data.data, 
            })
        }
       await dispatch({type: AFTER_SEARCH});
    }
}

export const onUnMount = () => {
    return (dispatch) => {
        dispatch({type: ON_UNMOUNT});
    }
}