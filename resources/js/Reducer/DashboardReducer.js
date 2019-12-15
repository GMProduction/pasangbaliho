import { 
    FETCH_PERMINTAAN_HARGA,
    FETCH_QTY_MEDIA,
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
 }

 export default function DashboardReducer(state = initialState, action) {
     switch (action.type) {
        case FETCH_QTY_MEDIA:
            return {
                ...state,
                qtyMedia: action.data,
            }
        case FETCH_QTY_MITRA:
            return {
                ...state,
                qtyMitra: action.data,
            }
        case FETCH_QTY_ADVERTISER:
            return {
                ...state,
                qtyAdvertiser: action.data,
            }
        case FETCH_PERMINTAAN_HARGA:
             return {
                 ...state,
                 dataPermintaanHarga: action.data,
             }
        case FETCH_MEDIA_IKLAN:
            return {
                ...state,
                dataPermintaanAssets: action.data,
            }
         default:
             return state
     }
 }