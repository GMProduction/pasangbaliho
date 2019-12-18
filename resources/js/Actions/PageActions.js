import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
    PAGE_REDIRECT,
} from './type';

export const prepareMount = (status) => {
    return (dispatch) => {
        dispatch({type: PREPARE_MOUNT, status: status})
    }
}

export const onMounted = (title) => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: title})
    }
}
export const redirectPage = (param) => {
    return (dispatch) => {
        dispatch({type: PAGE_REDIRECT, redirect: param})
    }
}

export const pageOnProgress = (progress, status) => {
    return (dispatch) => {
        dispatch({type: PAGE_PROGRESS, progress: progress, status: status})
    }
}

export const prepareSearch = () => {
    return (dispatch) => {
        dispatch({type: PREPARE_SEARCH})   
    }
}

export const onSearched = () => {
    return (dispatch) => {
        dispatch({type: ON_SEARCHED})
    }
}