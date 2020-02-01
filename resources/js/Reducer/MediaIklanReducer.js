import {
    FETCH_MEDIA_IKLAN,
    FETCH_QTY_MEDIA_IKLAN,
    FETCH_MEDIA_IKLAN_BY_ID,
    FETCH_IMAGE_BY_ID,
    FETCH_MEDIA_USED,
    FETCH_KATEGORI,
    FETCH_MITRA,
    FETCH_PROVINSI,
    FETCH_KOTA,
    ON_CHANGE,
} from '../Actions/type';

const initialState = {
    dataMedia: [],
    dataImage: [],
    dataMediaUsage: [],
    dataMediaById: null,
    qtyMedia: 0,
    dataMediaByIdFound: false,
    dataKategori: null,
    dataProvinsi: null,
    dataKota: null,
    dataMitra: null
}

export default function MediaIklanReducer (state = initialState, action) {
    switch (action.type) {
        case FETCH_MEDIA_IKLAN:
            return {
                ...state,
                dataMedia: action.data
            }
        case FETCH_MEDIA_IKLAN_BY_ID:
            return {
                ...state,
                dataMediaById: action.data,
                dataMediaByIdFound: action.dataFound
            }
        case FETCH_IMAGE_BY_ID:
            return {
                ...state,
                dataImage: action.data,
            }
        case FETCH_QTY_MEDIA_IKLAN:
            return {
                ...state,
                qtyMedia: action.data,
            }
        case FETCH_MEDIA_USED:
            return {
                ...state,
                dataMediaUsage: action.data,
            }
        default:
            return state;
    }
}