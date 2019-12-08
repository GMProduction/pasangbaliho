import {
    FETCH_MEDIA_IKLAN,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from '../Actions/type';

import {dashboardAPI} from '../Controller/DashboardControll';

export const fetchMedia = (status, index) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        await dispatch({type: PREPARE_MOUNT, loadingStatus: 'Fetching Data Permintaan Media Iklan'})
        let resMedia = await dashboardAPI('/adminapi/mediaiklan/request?status='+stat+'&index='+index);
        if (resMedia.statusdata === 'success') {
           await dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.data})
        }
        await dispatch({type: ON_MOUNTED});
    }
}

export const searchMedia = (status, index) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        await dispatch({type: PREPARE_SEARCH});
            let resMedia = await dashboardAPI('/adminapi/mediaiklan/request?status='+stat+'&index='+index);
            if (resMedia.statusdata === 'success') {
                await dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.data})
             }
        await dispatch({type: AFTER_SEARCH});
    }
}

export const onUnMount = () => {
    return (dispatch) => {
        dispatch({type: ON_UNMOUNT})
    }
}