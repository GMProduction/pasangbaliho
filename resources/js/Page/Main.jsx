import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Navigasi from '../components/Material-UI/Navigasi/Navigasi';
import Footer from '../components/Material-UI/Navigasi/Footer';
import CssBaseline from '@material-ui/core/CssBaseline';
import { BrowserRouter } from 'react-router-dom';
import PageRouter from './PageRouter';
import { Provider } from 'react-redux';
import appStore from '../Store/appStore';

export default class Main extends Component {
    constructor(props) {
        super(props);
        // axios.defaults.baseURL = 'https://www.pasangbaliho.com/adminapi';
        axios.defaults.baseURL = 'http://localhost:8000/adminapi';
        // axios.defaults.baseURL = 'http://genossys.site/adminapi';
    }
    
    render() {
        return (
            <React.Fragment>
                <CssBaseline/>
                <div className='mainWrap'>
                    <BrowserRouter basename='/admin'>
                        <Navigasi/>
                        <main style={{backgroundColor: '#EEEEEE'}}>
                            <PageRouter/>
                        </main>
                        <Footer/>
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


