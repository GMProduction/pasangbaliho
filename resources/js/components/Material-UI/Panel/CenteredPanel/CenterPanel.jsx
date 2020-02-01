import React, { Component } from 'react';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';


export class CenterPanel extends Component {

    render(){
        const style ={
            paper:{
                backgroundColor: !this.props.color ? '#57AE5B' : this.props.color,
                color: 'white',
                paddingLeft: '25px',
                paddingRight: '25px', 
                height: '150px'
            },
            icon:{
                marginRight: '15px'
            },
            title: {
                fontFamily: 'Roboto Light'
            },
            link :{
                    color: 'white',
                    textDecoration: 'none',
                    height: '150px'
            }
        }
        return(
            <div>
                <Paper style={style.paper} component='div'>
                    <Box display='flex' alignItems="center" justifyContent='center' component={NavLink} to={this.props.link} style={style.link}>
                        <Box>
                            <Box display='flex' fontSize={60} alignItems="center" justifyContent='center'>
                                <Icon fontSize='inherit'>{this.props.icon}</Icon>
                            </Box>
                            <Box display='flex' alignItems="center" justifyContent='center'>
                                <Typography variant="h6" component="h3" style={style.title}>
                                    {this.props.title}
                                </Typography>
                            </Box>
                        </Box>
                    </Box>
                </Paper>
            </div>
        );
    }
    
}

export default CenterPanel;