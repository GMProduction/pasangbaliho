import { combineReducers } from 'redux';
import PageReducer from './PageReducer';
import DashboardReducer from './DashboardReducer';
import NegosiasiReducer from './NegosiasiReducer';
import MitraReducer from './MitraReducer';
import AdvertiserReducer from './AdvertiserReducer';
import MediaIklanReducer from './MediaIklanReducer';
import UtilityReducer from './UtilityReducer';
import PaymentReducer from './PaymentReducer';

const reducers = combineReducers({
    PageReducer,
    DashboardReducer,
    NegosiasiReducer,
    MitraReducer,
    AdvertiserReducer,
    MediaIklanReducer,
    UtilityReducer,
    PaymentReducer
});

export default reducers;