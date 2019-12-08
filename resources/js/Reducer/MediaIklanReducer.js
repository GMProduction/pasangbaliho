import {
    FETCH_MEDIA_IKLAN,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from '../Actions/type';

const initialState = {
    data: [],
    loadingBarProgress: 0,
    loadingStatus: 'Mohon Tunggu Sebentar...',
    pageLoading: true,
    dataLoading: true,
    error: null
}

export default function MediaIklanReducer (state = initialState, action) {
    switch (action.type) {
        case PREPARE_MOUNT:
            return {
                ...state,
                loadingBarProgress: 30,
                loadingStatus: action.loadingStatus
            }
        case ON_MOUNTED:
            return {
                ...state,
                loadingBarProgress: 100,
                pageLoading: false,
                dataLoading: false
            }
        case ON_UNMOUNT:
            return {
                ...state,
                data: [],
                loadingBarProgress: 0,
                loadingStatus: 'Mohon Tunggu Sebentar...',
                pageLoading: true,
                dataLoading: true,
                error: null
            }
        case PREPARE_SEARCH:
            return {
                ...state,
                dataLoading: true,
            }
        case AFTER_SEARCH: 
            return {
                ...state,
                dataLoading: false,
            }
        case FETCH_MEDIA_IKLAN:
            return {
                ...state,
                data: action.data
            }
        default:
            return state;
    }
}