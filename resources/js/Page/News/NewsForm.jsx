import React, {Component} from 'react'

import ReactQuill from 'react-quill';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTextfield from '../../components/Material-UI/Textfield/BasicTextfield';
import Dropzone from 'react-dropzone';
import RadioButton from '../../components/Material-UI/Radio/RadioButton';
import Divider from '@material-ui/core/Divider';
import Button from '@material-ui/core/Button';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted, onSubmit, onNotify } from '../../Actions/pageActions';
import {postNews} from '../../Actions/NewsActions';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import LoadingBar  from 'react-top-loading-bar';
import Fade from 'react-reveal/Fade';
import 'react-quill/dist/quill.snow.css';

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', link:'/dashboard/mediaiklan', active: false},
    {title: 'Form Media', icon: 'note',  active: true},
];

const radioItems = [
    {label: 'Publish', value: 'publish'},
    {label: 'Block', value: 'block'}
];

export class NewsForm extends Component {

    constructor(props) {
        super(props);
        this.onDrop = (files) => {
            this.setState({files})
        };
        this.state = {text: '', judul: '', files:[], status: 'publish'} // You can also pass a Quill Delta here
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

    handleChange = async (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleChangeBerita(value) {
        this.setState({ text: value })
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Berita')
    }

    handleSave = async () => {
        let data = new FormData();
        data.append('gambar', this.state.files[0])
        data.append('judul', this.state.judul)
        data.append('isi', this.state.text)
        data.append('status', this.state.status)
        this.props.onSubmit(true, 'Sedang Menyimpan Data...')
        let res = await this.props.postNews(data)
        if (res.status === 'success'){
            this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data')
            this.clearField()
        }else{
            this.props.onNotify(true, 'error', 'Gagal Menyimpan Data')
        }
        await this.props.onSubmit(false, '')
    }

    clearField = () => {
        this.setState({
            text: '', judul: '', files:[], status: 'publish'
        })
    }

    render(){
        const {pageProgress, pageLoadingStatus, pageLoading} = this.props.page;
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
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center">Data Berita</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <BasicTextfield label='Judul Berita' placeholder='Judul Berita' name='judul' value={this.state.judul} onChange={this.handleChange}/>
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
                                    <h4>Nama Gambar</h4>
                                    <ul>{files}</ul>
                                    </aside>
                                </section>
                                )}
                            </Dropzone>
                        </Box>
                        <RadioButton  label='Publikasi' items={radioItems} value={this.state.status} name='status' onChange={this.handleChange}/>
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
                        </BasicPanelContent>
                    </BasicPanel>
                </Fade>
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
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
        postNews: bindActionCreators(postNews, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(NewsForm);