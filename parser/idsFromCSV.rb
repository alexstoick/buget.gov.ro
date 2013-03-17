require 'CSV'

dir = 'sources/rogovdata1/'
idMinistere = []
idAltele = []
idSectiuni = []

Dir.glob(dir + '*.csv') do |file|
	csv = CSV.read(file)

	csv.shift
	csv.each do |row|
		numeInstitutie = row[4]
		idInstitutie = row[0]
		if numeInstitutie.start_with?("Minister")
			idMinistere.push(idInstitutie) unless idMinistere.include?(idInstitutie)
		else
			idAltele.push(idInstitutie) unless idAltele.include?(idInstitutie)
		end
	end
end

puts "["+idMinistere.join(",")+"]"
puts "["+idAltele.join(",")+"]"
