import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Navigasi from '../components/Material-UI/Navigasi/Navigasi';
import Footer from '../components/Material-UI/Navigasi/Footer';
import CssBaseline from '@material-ui/core/CssBaseline';
import { BrowserRouter, Route, Switch, Redirect } from 'react-router-dom';
import PageRouter from './PageRouter';
import { Provider } from 'react-redux';
import appStore from '../Store/appStore';
import Login from './Auth/Login'
import PageNotFound from '../components/Material-UI/PageInfo/PageNotFound'



export default class Main extends Component {
    constructor(props) {
        super(props);
    }
    
    render() {
        return (
            <React.Fragment>
                <CssBaseline/>
                <div className='mainWrap'>
                    <BrowserRouter basename='/admin'>
                        <Switch>
                        <Route exact path='/' component={Login}/> 
                        <Route path='/dashboard'>
                            <React.Fragment>
                                <Navigasi/>
                                <main style={{backgroundColor: '#EEEEEE'}}>
                                    <PageRouter/>
                                </main> 
                                <Footer/>
                             </React.Fragment>
                        </Route>
                        <Route component={PageNotFound}/>
                        </Switch>
                    </BrowserRouter>
                </div>
            </React.Fragment>
        );
    }
}

const MainConnect = () => (
    <Provider store={appStore}>
        <Main/>
    </Provider>
);
if (document.getElementById('root')) {
    ReactDOM.render(<MainConnect/>,document.getElementById('root'));
}


