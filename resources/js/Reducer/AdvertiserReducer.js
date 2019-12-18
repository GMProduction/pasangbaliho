import {
    FETCH_ADVERTISER,
    FETCH_ADVERTISER_BY_ID,
    FETCH_QTY_ADVERTISER
} from '../Actions/type';

const initialState = {
    dataAdvertiser: [],
    dataAdvertiserById: null,
    qtyAdvertiser: 0
}

export default function AdvertiserReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_ADVERTISER:
            return {
                ...state,
                dataAdvertiser: action.data,
            }
        case FETCH_ADVERTISER_BY_ID:
            return {
                ...state,
                dataAdvertiserById: action.data,
            }
        case FETCH_QTY_ADVERTISER:
            return {
                ...state,
                qtyAdvertiser: action.data,
            }
        default:
            return state;
    }
} 