import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Navigasi from '../components/Material-UI/Navigasi/Navigasi';
import Footer from '../components/Material-UI/Navigasi/Footer';
import CssBaseline from '@material-ui/core/CssBaseline';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import PageRouter from './PageRouter';
import { Provider } from 'react-redux';
import appStore from '../Store/appStore';
import Login from './Auth/Login'



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
                        <Route path='/dashboard' render={(props) =>
                             <React.Fragment>
                                <Navigasi/>
                                <main style={{backgroundColor: '#EEEEEE'}}>
                                    <PageRouter/>
                                    
                                </main> 
                                <Footer/>
                             </React.Fragment>
                        }/>
                        <Route render={() => <h1>Not Found</h1>}/>
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


