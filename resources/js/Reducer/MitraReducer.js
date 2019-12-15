import {
    FETCH_MITRA
} from '../Actions/type';

const initialState = {
    dataMitra: [],
}

export default function MitraReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_MITRA:
            return {
                ...state,
                dataMitra: action.data,
            }
        default:
            return state;
    }
}