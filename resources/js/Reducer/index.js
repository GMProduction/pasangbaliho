import { combineReducers } from 'redux';
import DashboardReducer from './DashboardReducer';
import NegosiasiReducer from './NegosiasiReducer';
import MitraReducer from './MitraReducer';
import AdvertiserReducer from './AdvertiserReducer';
import MediaIklanReducer from './MediaIklanReducer';

const reducers = combineReducers({
    DashboardReducer,
    NegosiasiReducer,
    MitraReducer,
    AdvertiserReducer,
    MediaIklanReducer
});

export default reducers;