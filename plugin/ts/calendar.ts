import * as calendarCore from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";

export const renderEventsCalendar = async () => {
  let eventsCalendar = document.getElementById("calendarEvents")
  // const events = await common.getEventPosts()
  // console.log(events)
  if (eventsCalendar ) {
    // const formatEvents = events.map((event)=>({
    //   id:event.event_name,
    //   title:event.event_name.replace('_',' '),
    //   start:event.start_date[0],
    //   end:event.end_date[0]
    // }))

    let calendar = new calendarCore.Calendar(eventsCalendar, {
      plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
      initialView: "dayGridMonth",
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,listWeek",
      },
     
    });
    calendar.render();
  }
};
