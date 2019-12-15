import React, { Component } from 'react';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import InputAdornment from '@material-ui/core/InputAdornment';
import Divider from '@material-ui/core/Divider';
import Icon from '@material-ui/core/Icon';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {formValue, prepareSubmit, onSubmit, postMedia} from '../../../Actions/MediaIklanActions';

const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
    adornment:{
        marginRight: '-12px'
    },
}
export class InformasiMarket extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hargaMarket: 0,latitude: '',longitude: '',url360: '', gambar1: null, gambar2: null, gambar3: null
        }
    }
    
    handleChange = async (e) => {
        let name = e.target.name;
        let value = e.target.value;
        this.setState({
            [e.target.name]: e.target.value
        })
        this.props.formValue(name, value);
    }

    initData = async (data) => {
        if (data !== null) {
            this.setState({
                hargaMarket: data.harga_market,
                latitude: data.latitude,
                longitude: data.longitude,
                url360: data.url_360
            })
        }
    }

    handleSave = async () => {
        await this.props.formValue('status', 'pending');
        await this.props.prepareSubmit()
        let data = this.props.mediaiklan.formMedia
        await this.props.postMedia(data)
        await this.props.onSubmit()
    }

    async componentDidMount () {
        let dataMediaById = this.props.dataMediaById;
        await this.initData(dataMediaById)
    }

    render() {
        return (
            <div>
                <BasicPanel>
                    <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Umum</Box>
                    </BasicPanelHeader>
                    <BasicPanelContent>
                    <TextField name='hargaMarket' id="hargaMarket" label="Harga Market" margin="dense" variant="outlined" fullWidth type='number'
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.hargaMarket}/>
                    <TextField name='latitude' id="latitude" label="Latitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.latitude}/>
                    <TextField name='longitude' id="longitude" label="Longitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.longitude}/>
                    <TextField name='url360' id="url360" label="URL 360" margin="dense" variant="outlined" fullWidth 
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.url360}/>
                    <input accept="image/*" style={{display: 'none'}} id="gambar1" type="file" name='gambar1'
                        />
                        <label htmlFor="gambar1">
                            <TextField disabled label="Gambar 1" variant="outlined" margin="dense" fullWidth
                                InputProps={{style: style.resize,
                                    endAdornment: <InputAdornment position="end" style={style.adornment}>
                                        <Button style={style.resize} component="span">Browse</Button>
                                    </InputAdornment>
                                }} InputLabelProps={{style: style.resize}}
                                value={this.state.gambar1 !== null ? this.state.gambar1.name : ''}/>
                        </label>
                    <input accept="image/*" style={{display: 'none'}} id="gambar2" type="file" name='gambar2'
                        />
                        <label htmlFor="gambar2">
                            <TextField disabled label="Gambar 2" variant="outlined" margin="dense" fullWidth
                                InputProps={{style: style.resize,
                                    endAdornment: <InputAdornment position="end" style={style.adornment}>
                                        <Button style={style.resize} component="span">Browse</Button>
                                    </InputAdornment>
                                }} InputLabelProps={{style: style.resize}}
                                value={this.state.gambar2 !== null ? this.state.gambar2.name : ''}/>
                        </label>
                    <input accept="image/*" style={{display: 'none'}} id="gambar3" type="file" name='gambar3'
                        />
                        <label htmlFor="gambar3">
                            <TextField disabled label="Gambar 3" variant="outlined" margin="dense" fullWidth
                                InputProps={{style: style.resize,
                                    endAdornment: <InputAdornment position="end" style={style.adornment}>
                                        <Button style={style.resize} component="span">Browse</Button>
                                    </InputAdornment>
                                }} InputLabelProps={{style: style.resize}}
                                value={this.state.gambar3 !== null ? this.state.gambar3.name : ''}/>
                        </label>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleSave}>
                                Tolak
                            </Button>
                            <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSave}>
                                Konfirmasi
                            </Button>
                        </Box>
                    </BasicPanelContent>
                </BasicPanel>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        mediaiklan: state.MediaIklanReducer,
    }
}

function mapDispatcToProps (dispatch) {
    return {
        formValue: bindActionCreators(formValue, dispatch),
        prepareSubmit: bindActionCreators(prepareSubmit, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        postMedia: bindActionCreators(postMedia, dispatch),
        
    }
}

export default connect(mapStateToProps, mapDispatcToProps)(InformasiMarket);
