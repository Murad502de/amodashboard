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
                path : '/Murad/amodashboard/activeleads',
                component : ActiveLeads 
            },

            {
                path : '/Murad/amodashboard/changingstages',
                component : ChangingStages
            },

            {
                path : '/Murad/amodashboard/keintasks',
                component : KeinTasks
            },

            {
                path : '/Murad/amodashboard/overduetasks',
                component : OverdueTasks
            },

            {
                path : '/Murad/amodashboard/usagetime',
                component : UsageTime
            },

            {
                path : '/talktime',
                component : TalkTime
            }
        ],

        mode : 'history'
    }
);