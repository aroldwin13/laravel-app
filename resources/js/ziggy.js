const Ziggy = {
  url: "http://localhost",
  port: null,
  defaults: {},
  routes: {
    "profile.edit": { uri: "profile", methods: ["GET", "HEAD"] },
    "profile.update": { uri: "profile", methods: ["PATCH"] },
    "profile.destroy": { uri: "profile", methods: ["DELETE"] },
    submission: { uri: "submission", methods: ["GET", "HEAD"] },
    home: { uri: "home", methods: ["GET", "HEAD"] },
    bookmark: { uri: "bookmark", methods: ["GET", "HEAD"] },
    references: { uri: "references", methods: ["GET", "HEAD"] },
    faculty_Home: { uri: "faculty_Home", methods: ["GET", "HEAD"] },
    faculty_Bookmark: { uri: "faculty_Bookmark", methods: ["GET", "HEAD"] },
    faculty_References: { uri: "faculty_References", methods: ["GET", "HEAD"] },
    "submissions.store": { uri: "submissions", methods: ["POST"] },
    "submissions.edit": {
      uri: "submissions/{submission}/edit",
      methods: ["GET", "HEAD"],
      parameters: ["submission"],
      bindings: { submission: "id" },
    },
    "submissions.update": {
      uri: "submissions/{submission}",
      methods: ["PUT", "PATCH"],
      parameters: ["submission"],
      bindings: { submission: "id" },
    },
    "submissions.index": { uri: "submissions", methods: ["GET", "HEAD"] },
    "submissions.create": {
      uri: "submissions/create",
      methods: ["GET", "HEAD"],
    },
    "submissions.show": {
      uri: "submissions/{submission}",
      methods: ["GET", "HEAD"],
      parameters: ["submission"],
    },
    "submissions.destroy": {
      uri: "submissions/{submission}",
      methods: ["DELETE"],
      parameters: ["submission"],
      bindings: { submission: "id" },
    },
    register: { uri: "register", methods: ["GET", "HEAD"] },
    login: { uri: "login", methods: ["GET", "HEAD"] },
    "password.request": { uri: "forgot-password", methods: ["GET", "HEAD"] },
    "password.email": { uri: "forgot-password", methods: ["POST"] },
    "password.reset": {
      uri: "reset-password/{token}",
      methods: ["GET", "HEAD"],
      parameters: ["token"],
    },
    "password.update": { uri: "reset-password", methods: ["POST"] },
    "verification.notice": { uri: "verify-email", methods: ["GET", "HEAD"] },
    "verification.verify": {
      uri: "verify-email/{id}/{hash}",
      methods: ["GET", "HEAD"],
      parameters: ["id", "hash"],
    },
    "verification.send": {
      uri: "email/verification-notification",
      methods: ["POST"],
    },
    "password.confirm": { uri: "confirm-password", methods: ["GET", "HEAD"] },
    logout: { uri: "logout", methods: ["POST"] },
  },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
