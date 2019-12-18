import {
    FETCH_KATEGORI,
    FETCH_PROVINSI,
    FETCH_KOTA
} from '../Actions/type';

const initialState = {
    dataKategori: [],
    dataProvinsi: [],
    dataKota: []
}

export default function UtilityReducer(state = initialState, action) {
    switch (action.type) {
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
                dataKota: action.data,
            }
        default:
            return state;
    }
} 