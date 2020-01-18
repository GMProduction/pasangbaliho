import React, { Component } from 'react';
import ReactQuill from 'react-quill';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import Paper from '@material-ui/core/Paper';
import Button from '@material-ui/core/Button';
import Divider from '@material-ui/core/Divider';
import Dropzone from 'react-dropzone';
import {mainApi} from '../../Controller/APIControll';
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import {withStyles} from '@material-ui/core';
import Snackbar from '@material-ui/core/Snackbar';
import MuiAlert from '@material-ui/lab/Alert';

import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted } from '../../Actions/pageActions';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import LoadingBar  from 'react-top-loading-bar';
import Fade from 'react-reveal/Fade';

const style = {
    paper: {
        padding: '20px'
    }
}

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];

export class Test extends Component {

    constructor(props) {
        super(props);
        this.onDrop = (files) => {
            this.setState({files})
        };
        this.state = { text: '', judul: '', files:[],submitProses: false, error: false, succes: false} // You can also pass a Quill Delta here
        this.handleChangeBerita = this.handleChangeBerita.bind(this)
    }

    modules = {
        toolbar: [
          [{ 'header': [1, 2, false] }],
          ['bold', 'italic', 'underline'],
          [{ 'align': [] }],
          [{'list': 'ordered'}, {'list': 'bullet'}],
          ['link'],
          ['clean']
        ],
      }

      handleCloseSnackBar = (param) => {
        if(param === 'error'){
            this.setState({
                error: false
            })
        }else{
            this.setState({
                success: false
            })
        }
    }

    handleSave = async () => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        this.setState({
            submitProses: true,
        })
        let data = new FormData();
        data.append('gambar', this.state.files[0])
        data.append('judul', this.state.judul)
        data.append('isi', this.state.text)
        data.append('status', 'publish')
        try{

            let response = await mainApi.post('/news/addNews', data, configJSON)
            console.log(response)
            if (response.status === 200) {
                this.clearField()
                this.setState({error: false,success: true})
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            this.setState({error: true,success: false})
        } finally {
            this.setState({
                submitProses: false,
            })
        }
    }

    clearField = () => {
            this.setState({
                text: '', judul: '', files:[]
            })
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Berita')
        
    }
    handleChangeBerita(value) {
        this.setState({ text: value })
    }

    handleChange = (e) =>{
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    
    render(){
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }
        const files = this.state.files.map(file => (
            <li key={file.name}>
              {file.name}
            </li>
          ));
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.error} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('error')}>
                    <Alert onClose={() => this.handleCloseSnackBar('error')} color="error">
                        Gagal Dalam Menyimpan Data. harap Isi Data Dengan Benar.
                    </Alert>
                </Snackbar>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.success} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('success')}>
                    <Alert onClose={() => this.handleCloseSnackBar('success')} color="success">
                        Berhasil Menyimpan Data.
                    </Alert>
                </Snackbar>
            <Fade bottom>
            <Paper style={style.paper}>
                <TextField name='judul' id="judul" label="Judul Berita" margin="dense" variant="outlined" fullWidth 
                    value={this.state.judul} onChange={this.handleChange}/>
                <Box style={{borderStyle: 'solid', borderColor: '#eeeeee', borderWidth: '2px', borderRadius: '2px', padding: '10px', marginBottom: '20px'}}>
                        <Dropzone onDrop={this.onDrop} accept='image/jpeg, image/png, image/jpg' multiple={false}>
                            {({getRootProps, getInputProps}) => (
                            <section className="container" >
                                <h4>Thumbnail Berita</h4>
                                <Box {...getRootProps({className: 'dropzone'})} display='flex' alignItems='center' justifyContent='center' style={{minHeight: '100px', borderStyle: 'dashed', backgroundColor: '#fafafa', borderColor: '#eeeeee', padding: '10px'}}>
                                    <input {...getInputProps()}  />
                                    <p style={{color: '#EEEEEE'}}>Geser dan Letakkan Gambar Di Sini, Atau Klik Untuk Memilih Gambar</p>
                                </Box>
                                <aside>
                                <h4>Gambar</h4>
                                <ul>{files}</ul>
                                </aside>
                            </section>
                            )}
                        </Dropzone>
                </Box>
                <ReactQuill value={this.state.text}
                modules={this.modules}
                  onChange={this.handleChangeBerita}
                  theme="snow"
                   />
                
                <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                <Box display="flex" justifyContent='flex-end' alignItems="center">
                    <Button variant="contained" color="primary" onClick={this.handleSave}>
                        Publish
                    </Button>
                </Box>
            </Paper>
            </Fade>
            

            <Backdrop
                    className={classes.backdrop}
                    open={this.state.submitProses}
                >
                    <Box display='flex' justifyContent='center' alignItems='center'>
                        <Box>
                            <Box display='flex' justifyContent='center' style={{marginBottom: '10px'}}>
                                <CircularProgress color="inherit" />
                            </Box>
                            <Box display='flex' justifyContent='center' alignItems='center'>
                            Mohon Tunggu Sebentar. Sedang Menyimpan Data...
                            </Box>
                        </Box>
                    </Box>
                    
                </Backdrop>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(Test);

function Alert(props) {
   return <MuiAlert elevation={6} variant="filled" {...props} />;
}