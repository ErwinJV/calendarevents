import * as calendarCore from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";

import {getPostsEvents} from './api'

export const renderEventsCalendar = async () => {
  let eventsCalendar = document.getElementById("calendarPosts")
   const events = await getPostsEvents()
   console.log(events)
  
  if (eventsCalendar && events ) {
    const formatEvents = events.map((event)=>({
      title:event.post_name,
      start:event.start_date,
      end:event.end_date
    }))

    let calendar = new calendarCore.Calendar(eventsCalendar, {
      plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
      initialView: "dayGridMonth",
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,listWeek",
      },
      events:formatEvents,
     
    });
    calendar.render();
  }else{
     console.log('Calendar ID not found')
  }
};

renderEventsCalendar()
