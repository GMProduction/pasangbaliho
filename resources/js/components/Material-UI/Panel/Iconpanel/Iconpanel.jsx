import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import Paper from '@material-ui/core/Paper';

const styles ={
    card: {
        position: 'relative',
     },
     panel: {
        position: 'relative',
        paddingLeft: '15px',
        paddingRight: '15px',
        height: '15px'
    },
     subHeaderContent:{
        padding: '15px 15px 0px 110px',
        minHeight: '65px' 
    },
    content:{
        padding: '15px 15px 10px 15px' 
    },
}

export class IconPanelContent extends Component {

    render() {
        return (
            <div>
                <Paper style={styles.content}>
                    {this.props.children}
                </Paper>
            </div>
        );
    }
}
export class IconPanelSubHeader extends Component {
    render() {

        return (
            <div>
                <Paper style={styles.subHeaderContent}>
                    {this.props.children}
                </Paper>
            </div>
        );
    }
}

export class IconPanelHeader extends Component{

    render() {
        const style ={
            overlay: {
                top: '0px',
                color: 'white',
                backgroundColor: !this.props.color ? '#123456' : this.props.color,
                borderRadius: '5px',
                paddingLeft: '15px',
                paddingRight: '15px',
                height: '80px',
                width: '80px',
                fontSize: '50px', 
            }
        }
        return (
            <div style={styles.panel}>
                <Box style={style.overlay} display='flex' alignItems='center'>
                    {this.props.children}
                </Box>
            </div>
        );
    }
}

export class Iconpanel extends Component {
    render() {

        const header = React.Children.map(this.props.children, (child, i) => {
            if (child.type.name === 'IconPanelHeader') {
                return child;
            }
        });
        const subHeader = React.Children.map(this.props.children, (child, i) => {
            if (child.type.name === 'IconPanelSubHeader') {
                return child;
            }
        });

        const content = React.Children.map(this.props.children, (child, i) => {
            if (child.type.name === 'IconPanelContent') {
                return child;
            }
        });
        return (
            <div style={styles.card}>
                {header}
                {subHeader}
                {content}
            </div>
        );
    }
}

export default Iconpanel;
