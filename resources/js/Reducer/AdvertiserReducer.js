import {
    FETCH_ADVERTISER,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from '../Actions/type';

const initialState = {
    dataAdvertiser: [],
    loadingBarProgress: 0,
    loadingStatus: 'Mohon Tunggu Sebentar...',
    pageLoading: true,
    dataLoading: true,
    error: null
}

export default function AdvertiserReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_ADVERTISER:
            return {
                ...state,
                dataAdvertiser: action.data,
            }
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
        case PREPARE_SEARCH:
            return {
                ...state,
                dataLoading: true
            }
        case AFTER_SEARCH:
            return {
                ...state,
                dataLoading: false
            }
        case ON_UNMOUNT:
            return {
                ...state,
                dataAdvertiser: [],
                loadingBarProgress: 0,
                loadingStatus: 'Mohon Tunggu Sebentar...',
                pageLoading: true,
                dataLoading: true,
                error: null
            }
        default:
                return {
                    ...state,
                    dataAdvertiser: [],
                    loadingBarProgress: 0,
                    loadingStatus: 'Mohon Tunggu Sebentar...',
                    pageLoading: true,
                    dataLoading: true,
                    error: null
                }
    }
} 