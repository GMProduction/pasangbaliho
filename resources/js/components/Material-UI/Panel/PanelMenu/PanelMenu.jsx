import React, { Component } from 'react';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';

export class PanelMenu extends Component {

    
    render() {
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
        return (
            <div>
                <Paper style={style.paper} component='div'>
                    <Box display="flex" alignItems="center" component={NavLink} to={this.props.link} style={style.link}>
                        <Box fontSize={50} display="flex" alignItems="center" style={style.icon}>
                            <Icon fontSize='inherit'>{this.props.icon}</Icon>
                        </Box>
                        <Box alignItems="center">
                            <Typography variant="h6" component="h3" style={style.title}>
                                {this.props.title}
                            </Typography>
                            <Typography component="p" style={style.title}>
                                {this.props.subTitle}
                            </Typography>
                        </Box>
                    </Box>
                </Paper>
            </div>
        );
    }
}

export default PanelMenu;
