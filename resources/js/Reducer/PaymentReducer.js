FETCH_PAYMENT
import {
    FETCH_PAYMENT
} from '../Actions/type';

const initialState = {
    dataPayment: []
}

export default function PaymentReducer (state = initialState, action) {

    switch (action.type) {
        case FETCH_PAYMENT:
            return {
                ...state,
                dataPayment: action.data
            }
        default:
            return state;
    }
}