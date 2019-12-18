import { combineReducers } from 'redux';
import PageReducer from './PageReducer';
import DashboardReducer from './DashboardReducer';
import NegosiasiReducer from './NegosiasiReducer';
import MitraReducer from './MitraReducer';
import AdvertiserReducer from './AdvertiserReducer';
import MediaIklanReducer from './MediaIklanReducer';
import UtilityReducer from './UtilityReducer';

const reducers = combineReducers({
    PageReducer,
    DashboardReducer,
    NegosiasiReducer,
    MitraReducer,
    AdvertiserReducer,
    MediaIklanReducer,
    UtilityReducer
});

export default reducers;