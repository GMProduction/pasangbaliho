import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
    PREPARE_SUBMIT,
    ON_SUBMITED,
    PAGE_REDIRECT,
} from '../Actions/type';

const initialState = {
    pageTitle: '',
    pageLoading: true,
    pageProgress: 0,
    pageLoadingStatus: '',
    dataLoading: false,
    redirect: false
}

export default function PageReducer (state = initialState, action) {
    switch (action.type) {
        case PREPARE_MOUNT:
            return {
                ...state,
                pageTitle: '',
                pageLoading: true,
                pageLoadingStatus: action.status,
                pageProgress: 0,
            }
        case ON_MOUNTED:
            return {
                ...state,
                pageTitle: action.title,
                pageLoading: false,
                pageLoadingStatus: '',
                pageProgress: 100
            }
        case PAGE_PROGRESS: 
            return {
                ...state,
                pageProgress: action.progress,
                pageLoadingStatus: action.status
            }
        
        case PREPARE_SEARCH:
            return {
                ...state,
                dataLoading: true
            }
        case ON_SEARCHED :
            return {
                ...state,
                dataLoading: false
            }
        case PREPARE_SUBMIT :
            return {
                ...state,
                pageLoading: true,
                pageLoadingStatus: action.status,
                pageProgress: 30,
            }
        case ON_SUBMITED :
            return {
                ...state,
                pageLoading: false,
                pageLoadingStatus: '',
                pageProgress: 100,
            }
        case PAGE_REDIRECT:
            return {
                ...state,
                redirect: action.redirect
            }
        default:
            return state;
    }
}