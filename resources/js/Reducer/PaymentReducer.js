FETCH_PAYMENT
import {
    FETCH_PAYMENT,
    FETCH_PAYMENT_BY_ID
} from '../Actions/type';

const initialState = {
    dataPayment: [],
    dataPaymentById: null,
    dataPaymentByIdFound: false,
}

export default function PaymentReducer (state = initialState, action) {

    switch (action.type) {
        case FETCH_PAYMENT:
            return {
                ...state,
                dataPayment: action.data
            }
        case FETCH_PAYMENT_BY_ID:
            return {
                ...state,
                dataPaymentById: action.data,
                dataPaymentByIdFound: action.dataFound
            }
        default:
            return state;
    }
}