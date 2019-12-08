import { 
    PREPARE_MOUNT,
    ON_MOUNTED,
    FETCH_PERMINTAAN_HARGA,
    FETCH_QTY_BALIHO,
    FETCH_QTY_MITRA,
    FETCH_QTY_ADVERTISER,
    FETCH_MEDIA_IKLAN
 } from '../Actions/type';



 const initialState = {
    dataPermintaanHarga: [],
    dataPermintaanAssets: [],
    qtyMedia: 0,
    qtyMitra: 0,
    qtyAdvertiser: 0,
    loadingBarProgress: 0,
    loadingStatus: 'Mohon Tunggu Sebentar...',
    pageLoading: true,
    error: null
 }

 export default function DashboardReducer(state = initialState, action) {
     switch (action.type) {
        case PREPARE_MOUNT:
            return {
                ...state,
                loadingBarProgress: 20,
                pageLoading: true,
            }
        case ON_MOUNTED:
            return {
                ...state,
                loadingBarProgress: 100,
                pageLoading: false,
            }
        case FETCH_PERMINTAAN_HARGA:
             return {
                 ...state,
                 dataPermintaanHarga: action.data,
                 loadingBarProgress: action.progress,
                 loadingStatus: action.status,
             }
        case FETCH_MEDIA_IKLAN:
            return {
                ...state,
                dataPermintaanAssets: action.data,
                loadingBarProgress: action.progress,
                loadingStatus: action.status,
            }
        case FETCH_QTY_BALIHO:
            return {
                ...state,
                qtyMedia: action.data,
                loadingBarProgress: action.progress,
                loadingStatus: action.status,
            }
        case FETCH_QTY_MITRA:
            return {
                ...state,
                qtyMitra: action.data,
                loadingBarProgress: action.progress,
                loadingStatus: action.status,
            }
        case FETCH_QTY_ADVERTISER:
            return {
                ...state,
                qtyAdvertiser: action.data,
                loadingBarProgress: action.progress,
                loadingStatus: action.status,
            }
        
        case 'RESET':
            return {
                ...state,
                dataPermintaanHarga: [],
                qtyMedia: 0,
                qtyMitra: 0,
                qtyAdvertiser: 0,
                loadingBarProgress: 0,
                loadingStatus: 'Mohon Tunggu Sebentar...',
                pageLoading: true,
                error: null
            }
         default:
             return state
     }
 }