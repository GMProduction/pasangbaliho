import { combineReducers } from 'redux';
import PageReducer from './PageReducer';
import DashboardReducer from './DashboardReducer';
import NegosiasiReducer from './NegosiasiReducer';
import MitraReducer from './MitraReducer';
import AdvertiserReducer from './AdvertiserReducer';
import MediaIklanReducer from './MediaIklanReducer';

const reducers = combineReducers({
    PageReducer,
    DashboardReducer,
    NegosiasiReducer,
    MitraReducer,
    AdvertiserReducer,
    MediaIklanReducer
});

export default reducers;