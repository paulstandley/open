import React from 'react';
import ReactDOM from 'react-dom';

class FollowButton extends Component {
    constructor(props) {
        super(props);
        this.state = { 
            follow: false
         }
    }

    followUser() {
        axios.post('/follow/' + this.userId).then(resonse => {
            if(this.state.follow) {
                this.setState({follow: true})
            }
            console.log(resonse);
        }).catch(errors => {
            if(errors.response.status == 401) {
                window.location = '/login';
            }
        });
    }

    render() { 
        return ( 
            <React.Fragment>
                <buuton onClick={followUser}>{this.state.follow ? 'Unfollow' : 'Follow'}</buuton>
            </React.Fragment>
         );
    }
}
 
export default FollowButton;


if (document.getElementById('buttonId')) {
    ReactDOM.render(<FollowButton />, document.getElementById('buttonId'));
}
