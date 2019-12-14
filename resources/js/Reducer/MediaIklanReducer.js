import {
    FETCH_MEDIA_IKLAN,
    FETCH_MEDIA_IKLAN_BY_ID,
    FETCH_KATEGORI,
    FETCH_MITRA,
    FETCH_PROVINSI,
    FETCH_KOTA,
    ON_CHANGE,
} from '../Actions/type';

const initialState = {
    formMedia: {
        idBaliho: '',
        idClient: '',
        idKategori: '',
        namaMedia: '',
        lebar: 0,
        tinggi:0,
        luas:0,
        idProvinsi: '',
        idKota: '',
        alamat: '',
        latitude: '',
        longitude: '',
        hargaClient: 0,
        hargaMarket: 0,
        orientasi: '',
        venue: '',
        deskripsi: '',
        url360: '',
        status: ''
    },
    dataMedia: [],
    dataMediaById: null,
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
        case FETCH_MITRA:
            return {
                ...state,
                dataMitra: action.data,
            }
        case FETCH_KATEGORI:
            return {
                ...state,
                dataKategori: action.data,
            }
        case FETCH_PROVINSI:
            return {
                ...state,
                dataProvinsi: action.data,
            }
        case FETCH_KOTA:
            return {
                ...state,
                dataKota: action.data
            }
        case ON_CHANGE: 
            return {
                ...state,
                formMedia: {...state.formMedia,[action.name] : action.value}
            }
        default:
            return state;
    }
}