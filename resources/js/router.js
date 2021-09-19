import VueRouter from 'vue-router';

import ActiveLeads from './components/ActiveLeads/ActiveLeads';
import ChangingStages from './components/ChangingStages/ChangingStages';
import KeinTasks from './components/KeinTasks/KeinTasks';
import OverdueTasks from './components/OverdueTasks/OverdueTasks';
import TalkTime from './components/TalkTime/TalkTime';
import UsageTime from './components/UsageTime/UsageTime';


export default new VueRouter(
    {
        routes : [
            {
                path : '/activeleads',
                component : ActiveLeads 
            },

            {
                path : '/changingstages',
                component : ChangingStages
            },

            {
                path : '/Murad/amodashboard/keintasks',
                component : KeinTasks
            },

            {
                path : '/overduetasks',
                component : OverdueTasks
            },

            {
                path : '/talktime',
                component : TalkTime
            },

            {
                path : '/usagetime',
                component : UsageTime
            }
        ],

        mode : 'history'
    }
);