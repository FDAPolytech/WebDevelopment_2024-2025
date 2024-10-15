export const wait = async (ms: number) => {
    let start: number | null = null;
    const time = ms;
    const promise = new Promise<void>((resolve) => {
      function step(timestamp: number) {
        if (!start) start = timestamp as number;
        const progress = timestamp - start;
        if (progress < time) {
          window.requestAnimationFrame(step);
        } else {
          resolve();
        }
      }
      window.requestAnimationFrame(step);
    });
  
    return promise;
  };