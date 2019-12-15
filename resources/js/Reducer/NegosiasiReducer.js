import { 
    FETCH_PERMINTAAN_HARGA,
    FETCH_NEGOSIASI,
    FETCH_NEGOSIASI_BY_ID
 } from '../Actions/type';

 const initialState = {
     data: [],
     dataNegosiasi: [],
     dataNegosiasiById: null,
     dataNegosiasiByIdFound: false,
 }

 export default function NegosiasiReducer(state = initialState, action) {
     switch (action.type) {

         case FETCH_PERMINTAAN_HARGA:
            return {
                ...state,
                data: action.items
            }
        case FETCH_NEGOSIASI:
            return {
                ...state,
                dataNegosiasi: action.data
            }
        case FETCH_NEGOSIASI_BY_ID:
            return {
                ...state,
                dataNegosiasiById: action.data,
                dataNegosiasiByIdFound: action.dataFound
            }
         default:
            return state
     }
 }