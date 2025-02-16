const { PrismaClient } = require('@prisma/client');
const prisma = new PrismaClient();

async function main() {
  // Add a new testimonial
  const newTestimonial = await prisma.testimonial.create({
    data: {
      name: 'John Doe',
      photoUrl: 'https://example.com/john.jpg',
      feedback: 'Great service!',
    },
  });
  console.log('Added new testimonial:', newTestimonial);

  // Get all testimonials
  const allTestimonials = await prisma.testimonial.findMany();
  console.log('All testimonials:', allTestimonials);
}

main()
  .catch((e) => {
    throw e;
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
