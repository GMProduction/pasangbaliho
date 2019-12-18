import {
    FETCH_MITRA,
    FETCH_MITRA_BY_ID,
    FETCH_QTY_MITRA
} from '../Actions/type';

const initialState = {
    dataMitra: [],
    dataMitraById: null,
    qtyMitra: 0
}

export default function MitraReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_MITRA:
            return {
                ...state,
                dataMitra: action.data,
            }
        case FETCH_MITRA_BY_ID:
            return {
                ...state,
                dataMitraById: action.data,
            }
        case FETCH_QTY_MITRA:
            return {
                ...state,
                qtyMitra: action.data,
            }
        default:
            return state;
    }
}