import React, {Component} from 'react'
import BasicTable from './BasicTable';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import InputAdornment from '@material-ui/core/InputAdornment';
import IconButton from '@material-ui/core/IconButton';
import Tooltip from '@material-ui/core/Tooltip';
import Zoom from '@material-ui/core/Zoom';
import SearchIcon from '@material-ui/icons/Search';
import PrintIcon from '@material-ui/icons/Print';
import NoteAddIcon from '@material-ui/icons/NoteAdd';

import {withStyles} from '@material-ui/core';
import compose from 'recompose/compose';

const useStyles = theme => ({
    iconButton: {
        color: '#555555',
        marginLeft: '5px'
    }
});

export class CustomTable extends Component{

    constructor(props) {
        super(props);
        this.state = {
            search: '',
        }
    }

    handleChange = (e) =>{
        let v = e.target.value;
        if(v === ''){
            this.props.onSearch(v)
        }
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    onSearch = (e) => {
        let key = e.target.value;
        if (e.keyCode === 13) {
            this.props.onSearch(key)
        }        
    }

    render(){
        const { classes, button, columns, data, loading, title, onSearch } = this.props;
        let btnAdd, btnPrint;
        if(button !== undefined) {
            if ( button.length > 0){
            
                if( button.includes('add') ){
                    btnAdd = 
                    <Box>
                        <Tooltip TransitionComponent={Zoom} title="Tambah Mitra">
                            <IconButton classes={{
                                colorPrimary: classes.iconButton
                            }} size='small'  color="primary" aria-label="Add"
                                onClick={this.props.onAddClicked}>
                                    <NoteAddIcon/>
                            </IconButton>
                        </Tooltip>
                    </Box>
                }
    
                if(button.includes('print')){
                    btnPrint = 
                    <Box>
                        <Tooltip TransitionComponent={Zoom} title="Cetak Daftar Mitra">
                            <IconButton classes={{
                                colorPrimary: classes.iconButton
                            }} size='small'  color="primary" aria-label="Add"
                                onClick={this.props.onPrintClicked}>
                                    <PrintIcon/>
                            </IconButton>
                        </Tooltip>
                    </Box>
                }
            }
        }
        
        return(
            <div>
                <Box display='flex' alignItems='center'>
                    <Box display='flex' flexGrow={1}>
                        {title}
                    </Box>
                    <Box>
                        <TextField name='search' id="outlined-basic" placeholder="Cari..." margin="dense" variant="outlined" size="small"
                            InputProps={{
                                startAdornment: <InputAdornment position="start"><SearchIcon/></InputAdornment>,
                                }}
                            value={this.state.search} onChange={this.handleChange} onKeyUp={ (e, value) => {
                                if(e.keyCode === 13){
                                    this.props.onSearch(this.state.search)
                                }
                            }}
                        />
                    </Box>
                    {btnAdd}
                    {btnPrint}
                </Box>
                <BasicTable columns={columns} data={data} loading={loading}/>
            </div>
        );
    }
}

export default compose(
    withStyles(useStyles))
    (CustomTable);