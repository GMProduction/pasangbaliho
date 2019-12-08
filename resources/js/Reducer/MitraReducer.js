import {
    FETCH_MITRA,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PREPARE_SEARCH,
    AFTER_SEARCH,
    ON_UNMOUNT
} from '../Actions/type';

const initialState = {
    dataMitra: [],
    loadingBarProgress: 0,
    loadingStatus: 'Mohon Tunggu Sebentar...',
    pageLoading: true,
    dataLoading: true,
    error: null
}

export default function MitraReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_MITRA:
            return {
                ...state,
                dataMitra: action.data,
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
                    dataMitra: [],
                    loadingBarProgress: 0,
                    loadingStatus: 'Mohon Tunggu Sebentar...',
                    pageLoading: true,
                    dataLoading: true,
                    error: null
                }
        default:
            return {
                ...state,
                dataMitra: [],
                loadingBarProgress: 0,
                loadingStatus: 'Mohon Tunggu Sebentar...',
                pageLoading: true,
                dataLoading: true,
                error: null
            }
    }
}