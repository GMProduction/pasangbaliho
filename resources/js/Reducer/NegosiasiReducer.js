import { 
    FETCH_PERMINTAAN_HARGA
 } from '../Actions/type';

 const initialState = {
     data: []
 }

 export default function NegosiasiReducer(state = initialState, action) {
     switch (action.type) {
         case FETCH_PERMINTAAN_HARGA:
            return {
                ...state,
                data: action.items
            }
     
         default:
            return state
     }
 }