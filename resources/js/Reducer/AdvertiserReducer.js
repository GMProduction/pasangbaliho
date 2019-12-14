import {
    FETCH_ADVERTISER,
} from '../Actions/type';

const initialState = {
    dataAdvertiser: [],
}

export default function AdvertiserReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_ADVERTISER:
            return {
                ...state,
                dataAdvertiser: action.data,
            }
        default:
            return state;
    }
} 