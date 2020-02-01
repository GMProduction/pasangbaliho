import {
    FETCH_NEWS,
    FETCH_NEWS_BY_ID
} from '../Actions/type';

const initialState = {
    dataNews: [],
    dataNewsById: null,
    dataNewsByIdFound: false,
}

export default function NewsReducer (state = initialState, action) {
    switch(action.type){
        case FETCH_NEWS:
            return {
                ...state,
                dataNews: action.data
            }
        case FETCH_NEWS_BY_ID:
            return {
                ...state,
                dataNewsById: action.data,
                dataNewsByIdFound: action.dataFound
            }
        default:
            return state;
    }
}