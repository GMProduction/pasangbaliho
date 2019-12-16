import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
} from './type';

export const prepareMount = () => {
    return (dispatch) => {
        dispatch({type: PREPARE_MOUNT, status: 'Mohon Tunggu Sebentar'})
    }
}

export const onMounted = () => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: 'Dashboard'})
    }
}

export const pageOnProgress = () => {
    return (dispatch) => {
        await dispatch({type: PAGE_PROGRESS, progress: progress, status: 'Fetching Data...'})
    }
}s