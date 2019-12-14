import React, { Component } from 'react';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import ExpandLess from '@material-ui/icons/ExpandLess';
import ExpandMore from '@material-ui/icons/ExpandMore';
import Collapse from '@material-ui/core/Collapse';
import Button from '@material-ui/core/Button';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import Divider from '@material-ui/core/Divider';
import ListItemText from '@material-ui/core/ListItemText';
import { NavLink } from 'react-router-dom';
import Typography from '@material-ui/core/Typography';

export class PermintaanPenambahanAsset extends Component {
    constructor(props) {
        super(props);
        this.state = {
            open: true,
        }
        this.openHandle = this.openHandle.bind(this);
    }

    openHandle(){
        this.setState({
            open: !this.state.open
        })
    }
    
    render() {
        return (
            <div>
                <BasicPanel>
                    <BasicPanelHeader color='#9129AC'>
                    <Box flexGrow={1}>Permintaan Penambahan Media Iklan ( {this.props.data.length} )</Box>
                        <Box >
                            <Button style={{color: 'white'}} onClick={this.openHandle}>
                                {this.state.open ? <ExpandLess/> : <ExpandMore/>}
                            </Button>
                        </Box>
                    </BasicPanelHeader>
                    <BasicPanelContent>
                        <Collapse in={this.state.open} timeout='auto' unmountOnExit>
                            <List>
                                {
                                    this.props.data.length > 0 ?
                                    this.props.data.slice(0, 5).map( (row, i) => {
                                        return (
                                            <React.Fragment key={i}>
                                                <ListItem button alignItems="flex-start" component={NavLink} to={`/mediaiklan/permintaan/${row.id_baliho}`}>
                                                <ListItemText
                                                    primary={row.nama}
                                                    secondary={
                                                        <Typography noWrap={true}>{`${row.nama_baliho}`}</Typography>
                                                    }
                                                />
                                                </ListItem>
                                                <Divider variant="middle" component="li" />
                                            </React.Fragment>
                                        )
                                    } )
                                        
                                    :
                                    <ListItem>
                                        <Box display='flex' justifyContent='center'>Tidak Ada Permintaan Penambahan Asset</Box>
                                    </ListItem>
                                }
                            </List>
                            <Box fontSize={14} fontFamily="Lato" display="flex" justifyContent="flex-end" alignItems="center">
                            <Button component={NavLink} to='/mediaiklan/permintaan'>
                                Lihat Semua Baliho
                            </Button>
                        </Box>
                        </Collapse>
                    </BasicPanelContent>
                </BasicPanel>
            </div>
        );
    }
}

export default PermintaanPenambahanAsset;
