import React, { Component } from 'react';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import ExpandLess from '@material-ui/icons/ExpandLess';
import ExpandMore from '@material-ui/icons/ExpandMore';
import Collapse from '@material-ui/core/Collapse';
import Button from '@material-ui/core/Button';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import { NavLink } from 'react-router-dom';

export class PermintaanHarga extends Component {

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
                        <Box flexGrow={1}>Permintaan Harga Advertiser ( {this.props.data.length} )</Box>
                        <Box >
                            <Button style={{color: 'white'}} onClick={this.openHandle}>
                                {this.state.open ? <ExpandLess/> : <ExpandMore/>}
                            </Button>
                        </Box>
                    </BasicPanelHeader>
                    <BasicPanelContent>
                        <Collapse in={this.state.open} timeout='auto' unmountOnExit>
                            <Table style={{marginBottom: '15px'}}>
                                <TableHead>
                                    <TableRow>
                                        <TableCell align='center' style={{width: '10%'}}>#</TableCell>
                                        <TableCell align='left' style={{width: '40%'}}>Advertiser</TableCell>
                                        <TableCell align='left' style={{width: '30%'}}>Media</TableCell>
                                        <TableCell align='center' style={{width: '20%'}}>Kelola</TableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {
                                        this.props.data.length > 0 ?
                                        this.props.data.slice(0, 5).map((row, i) => {
                                           return ( 
                                            <TableRow key={i}>
                                                <TableCell align='center'>{i+1}</TableCell>
                                                <TableCell align='left'>{row.namaAdvertiser}</TableCell>
                                                <TableCell align='left'>{row.namaBaliho}</TableCell>
                                                <TableCell align='center'>
                                                    <Button variant="outlined" size='small' color="primary" component={NavLink} to={`/admin/negosiasi/permintaan/${row.id_transaksi}`}>
                                                         Detail
                                                    </Button>
                                                </TableCell>
                                            </TableRow>)
                                        }) 
                                        :
                                        <TableRow>
                                            <TableCell align='center' colSpan={4}>Tidak Ada Permintaan</TableCell>
                                        </TableRow>
                                    }
                                </TableBody>
                            </Table>
                            <Box fontSize={14} fontFamily="Lato" display="flex" justifyContent="flex-end" alignItems="center">
                                <Button component={NavLink} to='/admin/negosiasi/permintaan'>
                                    Lihat Semua Permintaan
                                </Button>
                            </Box>
                        </Collapse>
                    </BasicPanelContent>
                </BasicPanel>
            </div>
        );
    }
}

export default PermintaanHarga;
