import { PostEvent } from "../schema";

export const getPostsEvents = async ():Promise<PostEvent[] | undefined> => {
  try {
    let domain = window.location.origin;
    const response = await fetch(`${domain}/wp-json/calendar/v1/all`)
    const json = await response.json()
    return JSON.parse(json) as unknown as PostEvent[]
  } catch (error) {
    console.log(error)
  }
};
