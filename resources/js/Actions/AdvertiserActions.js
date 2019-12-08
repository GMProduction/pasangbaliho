import {
    FETCH_ADVERTISER,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from '../Actions/type';

import {dashboardAPI} from '../Controller/DashboardControll';

export const onMount = () => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_MOUNT, loadingStatus: 'Fetching Data Advertiser...'});
        let resAdvertiser = await dashboardAPI('/adminapi/advertiser/request?index=');
        if (resAdvertiser.statusdata === 'success') {
            await dispatch({
                type: FETCH_ADVERTISER,
                data: resAdvertiser.data.data
            })
        }
        await dispatch({type: ON_MOUNTED})
    }
}

export const onSearch = index => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_SEARCH, dataLoading: true})
        let resAdvertiser = await dashboardAPI('/adminapi/advertiser/request?index='+index);
        if (resAdvertiser.statusdata === 'success') {
            await dispatch({
                type: FETCH_ADVERTISER, 
                data: resAdvertiser.data.data, 
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